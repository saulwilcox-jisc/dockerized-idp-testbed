import React from "react";
import CssBaseline from "@material-ui/core/CssBaseline";
import { addDecorator } from "@storybook/react";
import { MuiThemeProvider } from "@material-ui/core/styles";
import { AuthContext } from "../src/context/auth";
import JiscTheme from "../src/theme/JiscTheme";

// Fake auth context to get storybook to work without having to pass a real token etc
const setAuthToken = () => {
  return;
};
const token = "mocktoken";

addDecorator((storyFn) => (
  <AuthContext.Provider value={{ token, setAuthToken }}>
    <MuiThemeProvider theme={JiscTheme}>
      <CssBaseline />
      {storyFn()}
    </MuiThemeProvider>
  </AuthContext.Provider>
));
