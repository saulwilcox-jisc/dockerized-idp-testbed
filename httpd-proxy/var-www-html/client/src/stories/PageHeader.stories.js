import React from "react";
import PageHeader from "../components/PageHeader";
import { action } from "@storybook/addon-actions";

export default {
  component: PageHeader,
  title: "Page header",
};

export const basic = () => <PageHeader title="Something X-ray" />;
