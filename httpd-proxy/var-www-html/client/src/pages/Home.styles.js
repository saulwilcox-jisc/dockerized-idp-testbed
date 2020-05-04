import { makeStyles } from "@material-ui/core/styles";

const useStyles = makeStyles((theme) => ({
  buttonContainer: {
    display: "flex",
    justifyContent: "space-between",
    marginTop: theme.spacing(2),
  },
  buttonContainerStart: {
    justifyContent: "flex-start",
  },
  buttonContainerEnd: {
    display: "flex",
    justifyContent: "flex-end",
    flexDirection: "row",
    "& > :first-child": {
      marginRight: "1.8rem",
    },
  },
  shareLinkContainer: {
    display: "flex",
    marginTop: theme.spacing(3),
    alignItems: "center",
  },
  icon: {
    marginRight: theme.spacing(0.5),
    color: "#007aaa",
  },
  link: {
    textDecoration: "underline",
  },
  gridSpacing: {
    paddingTop: theme.spacing(5),
  },
  loadingContainer: {
    display: "flex",
    justifyContent: "center",
    height: "100vh",
    alignItems: "center",
  },
}));

export default useStyles;
