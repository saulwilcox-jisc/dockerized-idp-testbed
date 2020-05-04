import React, { useState } from "react";
import { CircularProgress, Typography } from "@material-ui/core";
import useStyles from "../../../pages/Home.styles";
import TextField from "@material-ui/core/TextField";

const MainContact = (props) => {
  const { productInstanceId } = props;

  const classes = useStyles();

  const loading = false;

  return loading ? (
    <div className={classes.loadingContainer}>
      <CircularProgress />
    </div>
  ) : (
    <div className={classes.formGroup}>
      <Typography variant="h5">Who is the main point of contact</Typography>
      <Typography variant="body1" className={classes.formGroupDescription}>
        This explains what the main point of contact does.
      </Typography>
      <div>
        <TextField id="first-name" label="First name" />
      </div>
      <div>
        <TextField id="last-name" label="Last name" />
      </div>
      <div>
        <TextField id="email" label="Email" />
      </div>
    </div>
  );
};

export default MainContact;
