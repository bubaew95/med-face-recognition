import React from "react";
import { Platform } from "react-native";
import {
  createStackNavigator,
  createBottomTabNavigator
} from "react-navigation";

import HomeScreen from "../screens/HomeScreen";
import ItemsScreen from "../screens/ItemsScreen";
import ViewScreen from "../screens/ViewScreen";

const config = Platform.select({
  web: { headerMode: "screen" },
  default: {}
});

const HomeStack = createStackNavigator(
  {
    Home: HomeScreen,
    // Items: ItemsScreen,
    ViewItem: ViewScreen
  },
  config
);

export default HomeStack;
