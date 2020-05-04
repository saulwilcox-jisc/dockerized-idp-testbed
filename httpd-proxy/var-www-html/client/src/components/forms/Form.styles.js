import { makeStyles } from "@material-ui/core/styles";

const useStyles = makeStyles((theme) => ({
  formContainer: {
    display: "flex",
    flexDirection: "column",
    backgroundColor: "#F2F2F2",
    padding: theme.spacing(3),
    marginTop: theme.spacing(3),
  },
  formGroupDescription: {
    marginTop: theme.spacing(2),
    fontWeight: 300,
  },
  formControl: {
    marginTop: theme.spacing(2),
  },
  selectElement: {},
  radioGroup: {
    marginTop: theme.spacing(2),
  },
  actionContainer: {
    marginTop: theme.spacing(2),
  },
  table: {
    marginTop: theme.spacing(2),
    marginBottom: theme.spacing(2),
  },
  tableLoading: {
    opacity: "0.2",
  },
  loadingContainer: {
    display: "flex",
    justifyContent: "center",
    alignItems: "center",
  },
}));

export default useStyles;
