import React from "react";
import { render, fireEvent, cleanup } from "../utils/test-utils";
import JiscButton from "../components/JiscButton";

const mockFunction = jest.fn();

afterEach(cleanup);

it("Renders", () => {
  const { getByText } = render(
    <JiscButton variant="primary">Hello world</JiscButton>
  );
  expect(getByText.toBeInTheDocument);
});

it("Renders a html button element", () => {
  const { container } = render(
    <JiscButton variant="primary">Button</JiscButton>
  );
  expect(container.getElementsByTagName("button")[0]).toBeInTheDocument();
});

it("Has text within button", () => {
  const { getByText } = render(
    <JiscButton variant="primary">Hello world</JiscButton>
  );
  expect(getByText("Hello world")).toBeInTheDocument();
});

it("Fires a click event when clicked", () => {
  const { getByText } = render(
    <JiscButton variant="primary" onClick={mockFunction}>
      Button
    </JiscButton>
  );
  fireEvent.click(getByText("Button"));
  expect(mockFunction).toHaveBeenCalledTimes(1);
});

it("Can be focussed", () => {
  const { container } = render(
    <JiscButton variant="primary">Button</JiscButton>
  );

  container.firstChild.focus();
  expect(container.firstChild).toHaveFocus();
  container.firstChild.blur();
  expect(container.firstChild).not.toHaveFocus();
});

it("Renders a primary variant", () => {
  const { getByTestId } = render(
    <JiscButton variant="primary">button</JiscButton>
  );

  expect(getByTestId("primary")).toBeInTheDocument();
  expect(getByTestId("primary")).toHaveStyle("background-color: #007aaa");
});

it("Renders a secondary variant", () => {
  const { getByTestId } = render(
    <JiscButton variant="secondary">button</JiscButton>
  );

  expect(getByTestId("secondary")).toBeInTheDocument();
  expect(getByTestId("secondary")).toHaveStyle("background-color: #f7f7f7");
});

it("Renders a ghost variant", () => {
  const { getByTestId } = render(
    <JiscButton variant="ghost">button</JiscButton>
  );

  expect(getByTestId("ghost")).toBeInTheDocument();
  expect(getByTestId("ghost")).toHaveStyle("background-color: transparent");
});

it("Renders a link variant", () => {
  const { getByTestId } = render(
    <JiscButton variant="link">button</JiscButton>
  );

  expect(getByTestId("link")).toBeInTheDocument();
  expect(getByTestId("link")).toHaveStyle("text-decoration: underline");
  expect(getByTestId("link")).toHaveStyle("border: 0");
});

it("Can be disabled", () => {
  const { container } = render(
    <JiscButton variant="primary" disabled>
      Button
    </JiscButton>
  );

  expect(container.firstChild).toHaveAttribute("disabled");
});

it("Can recieve an id", () => {
  const { container } = render(
    <JiscButton variant="primary" id="my-id">
      Button
    </JiscButton>
  );

  expect(container.firstChild).toHaveAttribute("id");
  expect(container.firstChild.id).toEqual("my-id");
});
