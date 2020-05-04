import React from "react";
import { Typography } from "@material-ui/core";
import { FormPropTypes } from "../../../propTypes";

export const LegalAndTermsForm = ({ form }) => {
  return (
    <div>
      <Typography variant="h4">{form.title}</Typography>
    </div>
  );
};

LegalAndTermsForm.propTypes = {
  form: FormPropTypes.isRequired,
};

export default LegalAndTermsForm;
