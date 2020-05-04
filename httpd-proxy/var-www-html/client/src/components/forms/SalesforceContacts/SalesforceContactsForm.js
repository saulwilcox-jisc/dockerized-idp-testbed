import React, { useContext, useState, useEffect } from "react";
import { Typography, CircularProgress } from "@material-ui/core";
import axios from "axios";
import { FormPropTypes } from "../../../propTypes";
import SalesforceContactSelect from "./SalesforceContactSelect";
import SalesforceContactList from "./SalesforceContactsList";
import useStyles from "../Form.styles";
import { ProductInstanceContext } from "../../../context/productInstanceContext";
import { API_URL } from "../../../constants";
import useAuth from "../../../context/auth";

export const SalesforceContactsForm = ({ form }) => {
  const classes = useStyles();
  const { productInstance } = useContext(ProductInstanceContext);
  const { headerWithToken } = useAuth();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(false);
  const [requiresUpdate, setRequiresUpdate] = useState(true);
  const [contacts, setContacts] = useState();
  const [availableContacts, setAvailableContacts] = useState();

  useEffect(() => {
    const fetchSavedContacts = async () => {
      try {
        const response = await axios.get(
          `${API_URL}/product_instance_salesforce_contacts?product_instance=${productInstance["@id"]}`,
          { headerWithToken }
        );

        if (response.data["@type"] === "hydra:Collection") {
          setContacts(response.data["hydra:member"]);
          setRequiresUpdate(false);
        } else {
          setContacts(response.data);
        }
      } catch (err) {
        setError(err);
      }
    };

    const fetchAvailableContacts = async () => {
      try {
        const response = await axios.get(
          `${API_URL}/salesforce_contacts?account=17782`,
          { headerWithToken }
        );

        if (response.data["@type"] === "hydra:Collection") {
          setAvailableContacts(response.data["hydra:member"]);
          setRequiresUpdate(false);
        } else {
          setAvailableContacts(response.data);
        }
      } catch (err) {
        setError(err);
      }
    };

    fetchSavedContacts();
    fetchAvailableContacts();
  }, [requiresUpdate, headerWithToken, productInstance]);

  useEffect(() => {
    setLoading(false);
  }, [contacts]);

  const removeContact = async (contactId) => {
    try {
      setLoading(true);
      const response = await axios.delete(
        `${API_URL}/product_instance_salesforce_contacts/${contactId}`,
        { headerWithToken }
      );

      if (response.status === 204) {
        setRequiresUpdate(true);
      }
    } catch (err) {
      setError(err);
    }
  };

  const addContact = async (payload) => {
    try {
      setLoading(true);
      const response = await axios.post(
        `${API_URL}/product_instance_salesforce_contacts`,
        { ...payload, headerWithToken }
      );

      if (response.status === 201) {
        setRequiresUpdate(true);
      }
    } catch (err) {
      setError(err);
    }
  };

  if (error) {
    return <div>Error</div>;
  }

  return !contacts ? (
    <div className={classes.loadingContainer}>
      <CircularProgress />
    </div>
  ) : (
    <>
      <Typography variant="h4">{form.title}</Typography>
      <SalesforceContactSelect
        contacts={availableContacts}
        handleAddContact={addContact}
      />
      <SalesforceContactList
        contacts={contacts}
        productName={productInstance.product.name}
        onContactRemoval={removeContact}
        loading={loading}
      />
    </>
  );
};

SalesforceContactsForm.propTypes = {
  form: FormPropTypes.isRequired,
};

export default SalesforceContactsForm;
