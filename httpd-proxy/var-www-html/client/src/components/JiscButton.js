/* eslint-disable react/require-default-props */
import React from "react";
import PropTypes from "prop-types";
import clsx from "clsx";
import { makeStyles } from "@material-ui/core/styles";

const useStyles = makeStyles((theme) => ({
  root: {
    display: "flex",
    alignItems: "center",
    fontSize: "1.8rem",
    fontWeight: 300,
    lineHeight: "2.4rem",
    borderWidth: "0.1rem",
    borderStyle: "solid",
    borderRadius: "0.3rem",
    padding: [["0.5rem", "1.7rem"]],
    "&:focus, &:hover": {
      color: "#fff",
      backgroundColor: "#0092cb",
      borderColor: "#0092cb",
      transition: ["backgroundColor", "borderColor", "boxShadow"],
      transitionDuration: 300,
      boxShadow: theme.shadows[6],
    },
    "&:active, &:hover": {
      outline: "0",
    },
    "&:focus": {
      outline: "solid #fd6",
      borderRadius: "0",
      transition: "none",
    },
  },
  primary: {
    backgroundColor: "#007aaa",
    borderColor: "#007aaa",
    color: "#fff",
  },
  secondary: {
    color: "#007aaa",
    backgroundColor: "#f7f7f7",
    borderColor: "#f7f7f7",
  },
  ghost: {
    color: "#007aaa",
    backgroundColor: "transparent",
    borderColor: "#007aaa",
  },
  link: {
    display: "flex",
    flexDirection: "row",
    textDecoration: "underline",
    backgroundColor: "transparent",
    color: "#007aaa",
    fontFamily: "roboto",
    fontSize: 18,
    border: "0",
    "&:hover": {
      color: "#ae460e",
      transition: "color .2s ease",
      cursor: "pointer",
    },
    "&:focus": {
      color: "#007AAA",
      textDecoration: "none",
      backgroundColor: "#fd6",
      outline: "solid #fd6",
    },
    "&:focus:hover": {
      color: "#007AAA",
      textDecoration: "underline",
      backgroundColor: "#fd6",
      outline: "solid #fd6",
    },
    "&:active": {
      color: "#007AAA",
      textDecoration: "underline",
      backgroundColor: "#fd6",
      outline: "solid #fd6",
    },
    "&$disabled": {
      backgroundColor: "transparent",
      cursor: "not-allowed",
      color: "rgba(0, 0, 0, 0.87)",
    },
  },
  startIcon: {
    display: "flex",
    marginRight: 4.5,
    marginLeft: -4,
  },
  endIcon: {
    display: "flex",
    marginRight: -4,
    marginLeft: 4.5,
  },
  disabled: {
    cursor: "not-allowed",
  },
}));

const JiscButton = (props) => {
  const {
    children,
    variant,
    startIcon: startIconProp,
    endIcon: endIconProp,
    disabled = false,
    onClick,
    id,
  } = props;

  const classes = useStyles();

  const startIcon = startIconProp && (
    <span className={classes.startIcon}>{startIconProp}</span>
  );

  const endIcon = endIconProp && (
    <span className={classes.endIcon}>{endIconProp}</span>
  );

  return (
    <button
      className={clsx({
        [classes.root]: variant !== "link",
        [classes.link]: variant === "link",
        [classes.primary]: variant === "primary",
        [classes.secondary]: variant === "secondary",
        [classes.ghost]: variant === "ghost",
        [classes.disabled]: disabled === true,
      })}
      type="button"
      variant={variant}
      disabled={disabled}
      onClick={onClick}
      data-testid={variant}
      id={id}
    >
      {startIcon}
      {children}
      {endIcon}
    </button>
  );
};

JiscButton.propTypes = {
  children: PropTypes.node.isRequired,
  variant: PropTypes.string.isRequired,
  startIcon: PropTypes.node,
  endIcon: PropTypes.node,
  disabled: PropTypes.bool,
  onClick: PropTypes.func,
  id: PropTypes.string,
};

export default JiscButton;
