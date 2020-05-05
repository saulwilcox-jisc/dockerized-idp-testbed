import React from "react";
import { makeStyles } from "@material-ui/core/styles";

const useStyles = makeStyles((theme) => ({
  root: {
    borderBottom: [[theme.spacing(0.25), "solid", "#E5E5E5"]],
  },
  marginTop: {
    marginTop: theme.spacing(3),
  },
}));

const WashingLine = () => {
  const classes = useStyles();
  return <div className={classes.root} />;
};

export default WashingLine;
