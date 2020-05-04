import React from "react";
import { Typography } from "@material-ui/core";
import { FormPropTypes } from "../../../propTypes";

export const PaymentForm = ({ form }) => {
  return (
    <div>
      <Typography variant="h4">{form.title}</Typography>
    </div>
  );
};

PaymentForm.propTypes = {
  form: FormPropTypes.isRequired,
};

export default PaymentForm;
