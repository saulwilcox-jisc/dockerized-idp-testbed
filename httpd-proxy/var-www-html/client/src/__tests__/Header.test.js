import React from "react";
import { render, cleanup } from "../utils/test-utils";
import Header from "../layout/Header";
import { AuthContext } from "../context/auth";

afterEach(cleanup);
const setAuthToken = jest.fn();

it("Renders", () => {
  const { getByText } = render(
    <AuthContext.Provider value={{ setAuthToken }}>
      <Header />
    </AuthContext.Provider>
  );
  expect(getByText.toBeInTheDocument);
});

it("Renders the Jisc logo and is accessible", () => {
  const { getByTestId } = render(
    <AuthContext.Provider value={{ setAuthToken }}>
      <Header />
    </AuthContext.Provider>
  );
  expect(getByTestId("jisc-logo")).toBeInTheDocument();
  expect(getByTestId("jisc-logo").getAttribute("role")).toEqual("img");
  expect(getByTestId("jisc-logo").getAttribute("title")).toEqual("Jisc logo");
});

it("Displays a username", () => {
  const name = "John Smith";
  const { getByTestId } = render(
    <AuthContext.Provider value={{ setAuthToken }}>
      <Header />
    </AuthContext.Provider>
  );
  getByTestId("username").textContent = name;
  expect(getByTestId("username")).toBeInTheDocument();
  expect(getByTestId("username").textContent).toMatch(name);
});

it("Displays an icon before the username", () => {
  const { getByTestId } = render(
    <AuthContext.Provider value={{ setAuthToken }}>
      <Header />
    </AuthContext.Provider>
  );
  expect(getByTestId("username-icon")).toBeInTheDocument();
  expect(getByTestId("username-container").firstChild.nodeName).toEqual("svg");
});

it("Displays an organisation", () => {
  const organisation = "University of Oxford";
  const { getByTestId } = render(
    <AuthContext.Provider value={{ setAuthToken }}>
      <Header />
    </AuthContext.Provider>
  );
  getByTestId("organisation-icon").textContent = organisation;
  expect(getByTestId("organisation")).toBeInTheDocument();
  expect(getByTestId("organisation").textContent).toMatch(organisation);
});

it("Displays an icon before the organisation", () => {
  const { getByTestId } = render(
    <AuthContext.Provider value={{ setAuthToken }}>
      <Header />
    </AuthContext.Provider>
  );
  expect(getByTestId("organisation-icon")).toBeInTheDocument();
  expect(getByTestId("organisation-container").firstChild.nodeName).toEqual(
    "svg"
  );
});
