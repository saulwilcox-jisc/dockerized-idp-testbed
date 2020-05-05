import React, { useState, useEffect, useContext } from "react";
import { Grid, Container, Link, CircularProgress } from "@material-ui/core";
import { NavigateNext, NavigateBefore, MailOutline } from "@material-ui/icons";
import Header from "../layout/Header";
import PageHeader from "../components/PageHeader";
import FormStepper from "../components/FormStepper";
import WashingLine from "../components/WashingLine";
import JiscButton from "../components/JiscButton";
import useStyles from "./Home.styles";
import FormParent from "../components/FormParent";
import { ProductInstanceContext } from "../context/productInstanceContext";

function compare(a, b) {
  let comparison = 0;
  const displayOrderA = a.displayOrder;
  const displayOrderB = b.displayOrder;

  if (displayOrderA > displayOrderB) {
    comparison = 1;
  } else if (displayOrderA < displayOrderB) {
    comparison = -1;
  }
  return comparison;
}

const getSteps = (productInstance) => {
  const steps = productInstance.product.productSteps.map((productStep) => ({
    displayOrder: productStep.displayOrder,
    name: productStep.step.name,
    title: productStep.step.title,
    component: productStep.step.component,
    id: productStep.step.id,
  }));

  steps.sort(compare);
  return steps;
};

function getProductOptionGroups(productInstance) {
  const groups = productInstance.product.productOptionGroups.map(
    (productGroup) => ({
      name: productGroup.name,
      description: productGroup.description,
      options: productGroup.productOptions,
    })
  );

  return groups;
}

const Home = () => {
  const { productInstance, loading, error } = useContext(
    ProductInstanceContext
  );

  const [activeStep, setActiveStep] = useState(2);
  const [activeForm, setActiveForm] = useState({});
  const [completedForms, setCompletedForms] = useState([1]);
  const classes = useStyles();

  useEffect(() => {
    const steps = getSteps(productInstance);
    setActiveForm(steps.find((object) => object.displayOrder === 2));
  }, [productInstance]);

  // Need to render 404, 401 etc page here
  if (error) {
    return <div>{error.response.status}</div>;
  }

  const handleNext = () => {
    setActiveStep((prevActiveStep) => prevActiveStep + 1);
    const steps = getSteps(productInstance);
    setActiveForm(
      steps.find((object) => object.displayOrder === activeStep + 1)
    );
  };

  const handleBack = () => {
    setActiveStep((prevActiveStep) => prevActiveStep - 1);
    const steps = getSteps(productInstance);
    setActiveForm(
      steps.find((object) => object.displayOrder === activeStep - 1)
    );
  };

  const redirectToForm = (step) => {
    setActiveStep(step.displayOrder);
    setActiveForm(step);
  };

  let steps = [];
  let groups = [];

  if (productInstance) {
    steps = getSteps(productInstance);
    groups = getProductOptionGroups(productInstance);
  }

  return loading ? (
    <div className={classes.loadingContainer}>
      <CircularProgress />
    </div>
  ) : (
    <div>
      <Header />

      <PageHeader title={productInstance.product.name} />

      <Container>
        <Grid container spacing={3} className={classes.gridSpacing}>
          <Grid item xs={12} sm={3}>
            <FormStepper
              activeStep={activeStep}
              steps={steps}
              completedForms={completedForms}
              onFormStepClick={redirectToForm}
            />
            <WashingLine />

            <div className={classes.shareLinkContainer}>
              <MailOutline className={classes.icon} />
              <Link className={classes.link} href="/share">
                Share this
              </Link>
            </div>
          </Grid>
          <Grid item xs={12} sm={9}>
            <FormParent form={activeForm} />

            {/* remove the below div after demo, need to add the margin as a prop to washing line */}
            <div style={{ marginTop: "2.7rem" }} />
            <WashingLine />

            <div className={classes.buttonContainer}>
              <div className={classes.buttonContainerStart}>
                {activeStep === 1 ? null : (
                  <JiscButton
                    variant="link"
                    disabled={activeStep === 0}
                    startIcon={<NavigateBefore />}
                    onClick={handleBack}
                  >
                    Back
                  </JiscButton>
                )}
              </div>
              <div className={classes.buttonContainerEnd}>
                <JiscButton
                  variant="secondary"
                  className={classes.buttonSpaceRight}
                >
                  Save progress
                </JiscButton>
                <JiscButton
                  variant="primary"
                  endIcon={<NavigateNext />}
                  onClick={handleNext}
                >
                  {activeStep === steps.length ? "Purchase" : "Next"}
                </JiscButton>
              </div>
            </div>
          </Grid>
        </Grid>
      </Container>
    </div>
  );
};

export default Home;
