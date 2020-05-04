// @flow
import React, { useState } from "react";
import { BrowserRouter as Router, Route } from "react-router-dom";
import CssBaseline from "@material-ui/core/CssBaseline";
import { ThemeProvider } from "@material-ui/core";
import { AuthContext } from "./context/auth";
import JiscTheme from "./theme/JiscTheme";
import Home from "./pages/Home";
import Login from "./pages/Login";
import PrivateRoute from "./PrivateRoute";
import "./theme/index.css";
import { ProductInstanceProvider } from "./context/productInstanceContext";

function App() {
  const [authToken, setAuthToken] = useState(
    localStorage.getItem("token") || ""
  );

  const setToken = (data) => {
    localStorage.setItem("token", JSON.stringify(data));
    setAuthToken(data);
  };

  let headerWithToken = {};
  if (authToken) {
    headerWithToken = {
      headers: {
        Authorization: `Bearer ${authToken.replace(/\"/g, "")}`,
      },
    };
  }

  return (
    <AuthContext.Provider
      value={{
        authToken,
        setAuthToken: setToken,
        headerWithToken,
      }}
    >
      <Router>
        <ThemeProvider theme={JiscTheme}>
          <CssBaseline />
          <Route exact path="/login" component={Login} />
          <ProductInstanceProvider>
            <PrivateRoute path="/" component={() => <Home />} />
          </ProductInstanceProvider>
        </ThemeProvider>
      </Router>
    </AuthContext.Provider>
  );
}

export default App;
