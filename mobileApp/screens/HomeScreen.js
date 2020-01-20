import React from "react";
import { StyleSheet, Text, View } from "react-native";

import { Container, Content } from "native-base";
import Swiper from "react-native-swiper";

import CameraComponent from "../components/Camera";
import CameraPage from "../components/camera";

export default class HomeScreen extends React.Component {
  state = {
    outerScrollEnabled: true
  };

  verticalScroll = index => {
    if (index !== 1) {
      this.setState({
        outerScrollEnabled: false
      });
    } else {
      this.setState({
        outerScrollEnabled: true
      });
    }
  };

  render() {
    return (
      <View style={{ flex: 1 }}>
        <CameraPage {...this.props} />
      </View>
    );
  }
}

HomeScreen.navigationOptions = {
  // title: "МЕД ЧР"
  header: null
};
const styles = StyleSheet.create({
  slideDefault: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    backgroundColor: "#9DD6EB"
  },
  text: {
    color: "white",
    fontSize: 30,
    fontWeight: "bold"
  }
});
