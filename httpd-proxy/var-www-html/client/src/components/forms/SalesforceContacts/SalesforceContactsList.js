import React, { useEffect } from "react";
import PropTypes from "prop-types";
import { CircularProgress, Typography } from "@material-ui/core";
import clsx from "clsx";
import TableContainer from "@material-ui/core/TableContainer";
import Table from "@material-ui/core/Table";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";
import TableCell from "@material-ui/core/TableCell";
import TableBody from "@material-ui/core/TableBody";
import JiscButton from "../../JiscButton";
import useStyles from "../Form.styles";

const SalesforceContactList = ({
  contacts,
  productName,
  onContactRemoval,
  loading,
}) => {
  const classes = useStyles();

  const handleRemoveContact = (e) => {
    const contactToBeRemoved = contacts.find(
      (item) => item["@id"] === e.target.id
    );

    onContactRemoval(contactToBeRemoved.id);
  };

  useEffect(() => {}, [contacts]);

  return !contacts ? (
    <div className={classes.loadingContainer}>
      <CircularProgress />
    </div>
  ) : (
    <div className={classes.formContainer}>
      <Typography variant="h5">Your {productName} contacts</Typography>
      <TableContainer>
        {loading ? (
          <div className={classes.loadingContainer}>
            <CircularProgress />
          </div>
        ) : null}
        <Table
          aria-label="Salesforce contacts table"
          className={clsx({
            [classes.table]: true,
            [classes.tableLoading]: loading,
          })}
        >
          {/* <caption>A table displaying the selected Salesforce contacts</caption> */}
          <TableHead>
            <TableRow>
              <TableCell>Name</TableCell>
              <TableCell>Email</TableCell>
              <TableCell>Role</TableCell>
              <TableCell align="right">&nbsp;</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {contacts.map((contact) => (
              <TableRow key={contact.id}>
                <TableCell>{contact.salesforceContact.name}</TableCell>
                <TableCell>{contact.salesforceContact.email}</TableCell>
                <TableCell>{contact.type}</TableCell>

                <TableCell align="right">
                  <JiscButton
                    variant="link"
                    onClick={handleRemoveContact}
                    id={contact["@id"]}
                    disabled={loading}
                  >
                    Remove
                  </JiscButton>
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
    </div>
  );
};

SalesforceContactList.propTypes = {
  contacts: PropTypes.arrayOf(PropTypes.shape({})).isRequired,
  productName: PropTypes.string.isRequired,
  onContactRemoval: PropTypes.func.isRequired,
  loading: PropTypes.bool.isRequired,
};

export default SalesforceContactList;
