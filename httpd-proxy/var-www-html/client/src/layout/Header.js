import React from "react";
import { Box, Container, Link } from "@material-ui/core";
import { PersonOutline, BusinessOutlined } from "@material-ui/icons";
import { makeStyles } from "@material-ui/core/styles";
import Logo from "../assets/svgs/Logo";
import useAuth from "../context/auth";
import JiscButton from "../components/JiscButton";

const useStyles = makeStyles((theme) => ({
  root: {
    backgroundColor: "#F2F2F2",
    paddingBottom: theme.spacing(3),
  },
  mainContainer: {
    display: "flex",
    justifyContent: "space-between",
  },
  accountInfoContainer: {
    display: "flex",
    justifyContent: "flex-end",
    flexDirection: "column",
  },
  accountInfoItem: {
    display: "flex",
    justifyContent: "flex-end",
  },
  icon: {
    marginRight: theme.spacing(0.5),
  },
  link: {
    textDecoration: "underline",
  },
}));

const Header = () => {
  const { setAuthToken } = useAuth();

  const LogOut = () => {
    setAuthToken();
    localStorage.removeItem("token");
  };

  const classes = useStyles();
  return (
    <Box className={classes.root}>
      <Container>
        <Box className={classes.mainContainer}>
          <Logo />
          <Box className={classes.accountInfoContainer}>
            <Box
              className={classes.accountInfoItem}
              data-testid="username-container"
            >
              <PersonOutline
                className={classes.icon}
                data-testid="username-icon"
              />
              <Link
                className={classes.link}
                href="/profile"
                data-testid="username"
              >
                John Doe
              </Link>
              {/* <JiscButton variant="ghost" onClick={LogOut}>
                Logout
              </JiscButton> */}
            </Box>
            <Box
              className={classes.accountInfoItem}
              mt={1}
              data-testid="organisation-container"
            >
              <BusinessOutlined
                className={classes.icon}
                data-testid="organisation-icon"
              />
              <Link
                className={classes.link}
                href="/account-"
                data-testid="organisation"
              >
                University of Oxford
              </Link>
            </Box>
          </Box>
        </Box>
      </Container>
    </Box>
  );
};

export default Header;
