import { Dimensions } from "react-native";

const resizeComponent = (value, percentage) => {
  return value - value * (percentage / 100);
};

const Window = {
  Height: Dimensions.get("window").height,
  Width: Dimensions.get("window").width
};

const CardContainerSize = {
  Width: resizeComponent(Window.Width, 100),
  Height: resizeComponent(150, 5)
};

export { resizeComponent, Window, CardContainerSize };
