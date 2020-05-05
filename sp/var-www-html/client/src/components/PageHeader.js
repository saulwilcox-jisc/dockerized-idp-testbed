import React from "react";
import PropTypes from "prop-types";
import { Box, Typography, Container, Link } from "@material-ui/core";
import { makeStyles } from "@material-ui/core/styles";
import WashingLine from "./WashingLine";

const useStyles = makeStyles((theme) => ({
  root: {},
  pageHeader: {
    display: "flex",
    justifyContent: "space-between",
    alignItems: "center",
    marginTop: theme.spacing(5),
    paddingBottom: theme.spacing(4),
  },
  link: {
    textDecoration: "underline",
  },
}));

const PageHeader = ({ title }) => {
  const classes = useStyles();
  return (
    <Box>
      <Container>
        <div className={classes.pageHeader}>
          <Typography variant="h2" data-testid="title">
            {title}
          </Typography>
          <Link className={classes.link} href="/help" data-testid="link">
            Get help
          </Link>
        </div>
        <WashingLine />
      </Container>
    </Box>
  );
};

PageHeader.propTypes = {
  title: PropTypes.string.isRequired,
};

export default PageHeader;
