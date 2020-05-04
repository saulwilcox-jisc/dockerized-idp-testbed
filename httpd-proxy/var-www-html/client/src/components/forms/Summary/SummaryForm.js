import React from "react";
import { Typography } from "@material-ui/core";
import { FormPropTypes } from "../../../propTypes";

export const SummaryForm = ({ form }) => {
  return (
    <div>
      <Typography variant="h4">{form.title}</Typography>
    </div>
  );
};

SummaryForm.propTypes = {
  form: FormPropTypes.isRequired,
};

export default SummaryForm;
