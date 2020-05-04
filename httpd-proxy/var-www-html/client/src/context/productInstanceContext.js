import React, { createContext } from "react";
import PropTypes from "prop-types";
import { CircularProgress } from "@material-ui/core";
import useAxiosGet from "../hooks/UseAxiosGet";
import { API_URL } from "../constants";
import useStyles from "../pages/Home.styles";

const ProductInstanceContext = createContext();

const ProductInstanceProvider = ({ children }) => {
  const { data: productInstance, loading, error } = useAxiosGet(
    `${API_URL}/product_instances/5`
  );

  const classes = useStyles();

  if (error) {
    return <div>Error</div>;
  }

  return loading ? (
    <div className={classes.loadingContainer}>
      <CircularProgress />
    </div>
  ) : (
    <ProductInstanceContext.Provider
      value={{ productInstance, loading, error }}
    >
      {children}
    </ProductInstanceContext.Provider>
  );
};

ProductInstanceProvider.propTypes = {
  children: PropTypes.node.isRequired,
};

export { ProductInstanceProvider, ProductInstanceContext };
