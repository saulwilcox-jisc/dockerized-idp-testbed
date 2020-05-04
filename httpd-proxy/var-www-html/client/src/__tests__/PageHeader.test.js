import React from "react";
import { render, cleanup } from "../utils/test-utils";

import PageHeader from "../components/PageHeader";

afterEach(cleanup);

it("Renders", () => {
  const { getByText } = render(<PageHeader title="Hello world" />);
  expect(getByText.toBeInTheDocument);
});

it("Renders with title", () => {
  const { getByText } = render(<PageHeader title="Hello world" />);
  expect(getByText("Hello world")).toBeInTheDocument();
});

it("Title renders as H2 element", () => {
  const { getByTestId } = render(<PageHeader title="Hello world" />);
  expect(getByTestId("title").tagName).toEqual("H2");
});

it("Renders with Get help link", () => {
  const { getByTestId } = render(<PageHeader title="Hello world" />);
  expect(getByTestId("link").textContent).toEqual("Get help");
});
