import React from "react";
import { Typography } from "@material-ui/core";
import { FormPropTypes } from "../../../propTypes";

export const ProductOptionsForm = ({ form }) => {
  return (
    <div>
      <Typography variant="h4">{form.title}</Typography>
    </div>
  );
};

ProductOptionsForm.propTypes = {
  form: FormPropTypes.isRequired,
};

export default ProductOptionsForm;
