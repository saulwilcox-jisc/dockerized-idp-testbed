// test-utils.js
import React from "react";
import { render } from "@testing-library/react";
import { ThemeProvider } from "@material-ui/core";
import JiscTheme from "../theme/JiscTheme";

// eslint-disable-next-line react/prop-types
const AllTheProviders = ({ children }) => {
  return <ThemeProvider theme={JiscTheme}>{children}</ThemeProvider>;
};

const customRender = (ui, options) =>
  render(ui, { wrapper: AllTheProviders, ...options });

// re-export everything
export * from "@testing-library/react";

// override render method
export { customRender as render };
