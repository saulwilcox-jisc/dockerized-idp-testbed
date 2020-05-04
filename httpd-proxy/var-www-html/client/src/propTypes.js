import PropTypes from "prop-types";

export const FormPropTypes = PropTypes.shape({
  displayOrder: PropTypes.number,
  name: PropTypes.string,
  title: PropTypes.string,
  component: PropTypes.string,
});

export const ExamplePropTypes = PropTypes.string;
