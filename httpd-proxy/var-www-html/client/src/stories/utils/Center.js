import React from "react";
import PropTypes from "prop-types";

const styles = {
  display: "flex",
  justifyContent: "center",
  alignItems: "center",
  height: "100vh",
};

const Center = ({ children }) => <div style={styles}>{children}</div>;

export default Center;

Center.propTypes = {
  children: PropTypes.node.isRequired,
};
