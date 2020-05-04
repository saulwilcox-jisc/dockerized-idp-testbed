import React from "react";
import { action } from "@storybook/addon-actions";
import JiscButton from "../components/JiscButton";
import Center from "./utils/Center";

export default { title: "Button", component: "JiscButton" };

export const primary = () => (
  <Center>
    <JiscButton variant="primary" onClick={action("click-event")}>
      Button
    </JiscButton>
  </Center>
);

export const secondary = () => (
  <Center>
    <JiscButton variant="secondary" onClick={action("click-event")}>
      Button
    </JiscButton>
  </Center>
);

export const ghost = () => (
  <Center>
    <JiscButton variant="ghost" onClick={action("click-event")}>
      Button
    </JiscButton>
  </Center>
);

export const link = () => (
  <Center>
    <JiscButton variant="link" onClick={action("click-event")}>
      Button
    </JiscButton>
  </Center>
);
