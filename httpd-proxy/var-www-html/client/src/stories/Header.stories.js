import React from "react";
import { action } from "@storybook/addon-actions";
import Header from "../layout/Header";

export default {
  component: Header,
  title: "Header",
};

export const basic = () => <Header />;
