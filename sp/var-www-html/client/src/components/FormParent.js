import React from "react";
import { FormPropTypes } from "../propTypes";
import {
  ProductOptionsForm,
  SalesforceContactsForm,
  PaymentForm,
  LegalAndTermsForm,
  SummaryForm,
  ServiceAgreementForm,
  AdditionalContactsForm,
} from "./forms";

const FormParent = ({ form }) => {
  return (
    <>
      {
        {
          ProductOptions: <ProductOptionsForm form={form} />,
          ServiceAgreement: <ServiceAgreementForm form={form} />,
          Contacts: <SalesforceContactsForm form={form} />,
          AdditonalContacts: <AdditionalContactsForm form={form} />,
          Payment: <PaymentForm form={form} />,
          LegalTerms: <LegalAndTermsForm form={form} />,
          Summary: <SummaryForm form={form} />,
        }[form.component]
      }
    </>
  );
};

FormParent.propTypes = {
  form: FormPropTypes.isRequired,
};

export default FormParent;
