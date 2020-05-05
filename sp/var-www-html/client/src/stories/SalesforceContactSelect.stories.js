import React from "react";
import SalesforceContactSelect from "../components/SalesforceContactSelect";

export default {
    component: SalesforceContactSelect,
    title: "Salesforce Contact Select",
};

export const basic = () => <SalesforceContactSelect productInstanceId={'/productInstances/6'} />;
