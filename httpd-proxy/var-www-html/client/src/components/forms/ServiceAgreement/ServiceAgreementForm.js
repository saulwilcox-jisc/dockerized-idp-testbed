import React from "react";
import { Typography } from "@material-ui/core";
import { FormPropTypes } from "../../../propTypes";

export const ServiceAgreementForm = ({ form }) => {
  return (
    <div>
      <Typography variant="h4">{form.title}</Typography>
    </div>
  );
};

ServiceAgreementForm.propTypes = {
  form: FormPropTypes.isRequired,
};

export default ServiceAgreementForm;
