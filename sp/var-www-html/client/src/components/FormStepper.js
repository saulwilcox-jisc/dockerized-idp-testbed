import React from "react";
import PropTypes from "prop-types";
import { makeStyles } from "@material-ui/core/styles";
import Stepper from "@material-ui/core/Stepper";
import Step from "@material-ui/core/Step";
import StepLabel from "@material-ui/core/StepLabel";
import clsx from "clsx";

const useStyles = makeStyles(() => ({
  stepLink: {
    textDecoration: "underline",
    color: "#007aaa",
    fontFamily: "roboto",
    fontSize: 18,
    border: "0",
    background: "transparent",
    "&:hover": {
      color: "#007aaa",
      cursor: "pointer",
    },
  },
  active: {
    fontFamily: "roboto",
    fontSize: 18,
    border: "0",
    color: "#000",
    textDecoration: "none",
    background: "transparent",
  },
}));

const FormStepper = ({
  activeStep,
  steps,
  completedForms,
  onFormStepClick,
}) => {
  const classes = useStyles();

  const redirect = (e) => {
    onFormStepClick(e.step);
  };

  return (
    <div>
      <Stepper activeStep={activeStep} orientation="vertical">
        {steps.map((step) => (
          <Step
            key={step.id}
            className={classes.active}
            completed={completedForms.includes(step.displayOrder)}
          >
            <StepLabel icon={" "}>
              <button
                type="button"
                className={clsx({
                  [classes.active]: activeStep === step.displayOrder,
                  [classes.stepLink]: activeStep !== step.displayOrder,
                })}
                onClick={() => redirect({ step })}
              >
                {step.name}
              </button>
            </StepLabel>
          </Step>
        ))}
      </Stepper>
    </div>
  );
};

FormStepper.propTypes = {
  activeStep: PropTypes.number.isRequired,
  steps: PropTypes.arrayOf(PropTypes.object).isRequired,
  completedForms: PropTypes.arrayOf(PropTypes.number).isRequired,
  onFormStepClick: PropTypes.func.isRequired,
};

export default FormStepper;
