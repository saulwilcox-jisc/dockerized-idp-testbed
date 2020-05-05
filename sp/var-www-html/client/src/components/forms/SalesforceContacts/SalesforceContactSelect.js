import React, { useState, useContext } from "react";
import PropTypes from "prop-types";
import { CircularProgress, Typography, FormControl } from "@material-ui/core";
import InputLabel from "@material-ui/core/InputLabel";
import Select from "@material-ui/core/Select";
import MenuItem from "@material-ui/core/MenuItem";
import RadioGroup from "@material-ui/core/RadioGroup";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import Radio from "@material-ui/core/Radio";
import useStyles from "../Form.styles";
import JiscButton from "../../JiscButton";
import useAuth from "../../../context/auth";
import { ProductInstanceContext } from "../../../context/productInstanceContext";

const SalesforceContactSelect = ({ contacts, handleAddContact }) => {
  const classes = useStyles();
  const { headerWithToken } = useAuth();
  const { productInstance } = useContext(ProductInstanceContext);
  const [payload, setPayload] = useState({
    productInstance: productInstance["@id"],
    salesforceContact: "",
    type: "",
    headerWithToken,
  });

  const handleTypeChange = (e) => {
    setPayload({ ...payload, type: e.target.value });
  };

  const handleContactChange = (e) => {
    setPayload({ ...payload, salesforceContact: e.target.value });
  };

  return !contacts ? (
    <div className={classes.loadingContainer}>
      <CircularProgress />
    </div>
  ) : (
    <div className={classes.formContainer}>
      <Typography variant="h5">Select product contacts</Typography>

      <FormControl variant="outlined" className={classes.formControl}>
        <InputLabel id="select-product-contacts-label">Name</InputLabel>
        <Select
          labelId="select-product-contacts-label"
          id="select-product-contacts"
          value={payload.salesforceContact}
          onChange={handleContactChange}
          label="Name"
        >
          {contacts.map((choice) => (
            <MenuItem value={choice["@id"]} key={choice.id}>
              {choice.name}
            </MenuItem>
          ))}
        </Select>
      </FormControl>

      <FormControl className={classes.formControl}>
        <RadioGroup
          aria-label="contact-type"
          name="type"
          required
          onChange={handleTypeChange}
        >
          <FormControlLabel
            value="primary"
            control={<Radio color="default" />}
            label="Primary contact"
          />
          <FormControlLabel
            value="secondary"
            control={<Radio color="default" />}
            label="Secondary contact"
          />
        </RadioGroup>
      </FormControl>
      <div className={classes.actionContainer}>
        <JiscButton variant="primary" onClick={() => handleAddContact(payload)}>
          Add contact
        </JiscButton>
      </div>
    </div>
  );
};

SalesforceContactSelect.propTypes = {
  contacts: PropTypes.arrayOf(
    PropTypes.shape({
      "@id": PropTypes.string,
      "@type": PropTypes.string,
      id: PropTypes.number,
      name: PropTypes.string,
      email: PropTypes.string,
      phone: PropTypes.string,
      externalId: PropTypes.string,
      account: PropTypes.string,
      roles: PropTypes.arrayOf(PropTypes.string),
    })
  ).isRequired,
  handleAddContact: PropTypes.func.isRequired,
};

export default SalesforceContactSelect;
