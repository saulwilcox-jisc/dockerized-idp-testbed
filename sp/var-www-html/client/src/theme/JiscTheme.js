import { createMuiTheme } from "@material-ui/core/styles";

const JiscTheme = createMuiTheme({
  // Custom theme here
  jiscPalette: {
    blueDeepCerulean: "#007aaa",
    greyAlto: "#D9D9D9",
  },
  // Material UI overrides here
  palette: {
    background: {
      default: "#fff",
    },
    primary: {
      main: "#007aaa",
    },
  },
  typography: {
    htmlFontSize: 10,
  },
  // Jisc FEF spacing values = 0.9rem units
  spacing: (factor) => `${0.9 * factor}rem`,
  overrides: {
    MuiTypography: {
      body1: {
        fontSize: "1.8rem",
      },
      h5: {
        fontSize: "2.7rem",
        fontWeight: 300,
      },
    },
    MuiMenuItem: {
      root: {
        fontSize: "1.8rem",
      },
    },
    MuiTableCell: {
      root: {
        fontSize: "1.8rem",
      },
    },
    MuiLink: {
      root: {
        color: "#007aaa",
        fontSize: "1.8rem",
        textDecoration: "underline",
        "&:hover": {
          color: "#ae460e",
          transition: "color .2s ease",
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
        "&:visited": {
          color: "#609",
        },
      },
    },
    MuiStepper: {
      root: {
        padding: "0",
        paddingBottom: 45,
      },
    },
    MuiStepLabel: {
      vertical: {},
      label: {
        fontSize: 18,
        fontWeight: 400,
        "&$active": {
          fontWeight: 400,
          color: "red",
        },
        "&$completed": {
          fontWeight: 400,
        },
      },
    },
    MuiStepIcon: {
      root: {
        color: "#F7F7F7",
        "&$active": {
          color: "#F7F7F7",
        },
        "&$completed": {
          color: "#007AAA",
        },
        "&$active&$completed": {
          color: "#007AAA",
        },
      },
    },
    MuiStepConnector: {
      lineVertical: {
        borderLeftStyle: "none",
        borderLeftWidth: "0",
      },
    },
    MuiRadio: {
      root: {
        color: "#000",
        "&$checked": {
          color: "#000",
        },
      },
    },
    MuiInputBase: {
      root: {
        fontSize: "1.8rem",
      },
    },
  },
});

export default JiscTheme;
