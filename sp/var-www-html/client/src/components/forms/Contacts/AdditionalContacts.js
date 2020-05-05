import React, { useState } from "react";
import { CircularProgress, Typography } from "@material-ui/core";
import useStyles from "../../../pages/Home.styles";
import TextField from "@material-ui/core/TextField";
import JiscButton from "../../JiscButton";

const AdditionalContacts = (props) => {
  const { productInstanceId } = props;

  const classes = useStyles();

  const loading = false;

  return loading ? (
    <div className={classes.loadingContainer}>
      <CircularProgress />
    </div>
  ) : (
    <div className={classes.formGroup}>
      <Typography variant="h5">Additional contacts (optional)</Typography>
      <Typography variant="body1" className={classes.formGroupDescription}>
        This explains what an additional contact means and who they should add.
      </Typography>
      <div>
        <TextField id="email" label="Email" />
      </div>
      <JiscButton variant={"link"}>Add another contact</JiscButton>
    </div>
  );
};

export default AdditionalContacts;
