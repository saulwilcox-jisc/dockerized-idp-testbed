import React from "react";
import { Typography } from "@material-ui/core";
import { FormPropTypes } from "../../../propTypes";

export const AdditionalContactsForm = ({ form }) => {
  return (
    <div>
      <Typography variant="h4">{form.title}</Typography>
    </div>
  );
};

AdditionalContactsForm.propTypes = {
  form: FormPropTypes.isRequired,
};

export default AdditionalContactsForm;
