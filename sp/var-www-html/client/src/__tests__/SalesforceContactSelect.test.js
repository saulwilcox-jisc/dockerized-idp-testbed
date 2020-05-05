import React from "react";
import { render as rtlRender, cleanup } from "../utils/test-utils";
import SalesforceContactSelect from "../components/forms/SalesforceContacts/SalesforceContactSelect";
import { AuthContext } from "../context/auth";
import { ProductInstanceProvider } from "../context/productInstanceContext";

afterEach(cleanup);
const setAuthToken = jest.fn();
const contacts = [
  {
    "@id": "/test",
    "@type": "test",
    id: 1,
    name: "John Doe",
    email: "johndoe@test.com",
  },
];

const handleAddContact = jest.fn();

function render(ui, options) {
  function Wrapper(props) {
    return (
      <AuthContext.Provider value={{ setAuthToken }}>
        <ProductInstanceProvider {...props} />
      </AuthContext.Provider>
    );
  }

  return rtlRender(ui, { wrapper: Wrapper, ...options });
}

it("Renders", () => {
  const { getByText } = render(
    <SalesforceContactSelect
      contacts={contacts}
      handleAddContact={handleAddContact}
    />
  );
  expect(getByText.toBeInTheDocument);
});

it("Renders a Primary contact radio button option", () => {
  const { getByTestId } = render(
    <SalesforceContactSelect
      contacts={contacts}
      handleAddContact={handleAddContact}
    />
  );

  expect(getByTestId("primary-contact-radio")).toBeInTheDocument();
});
