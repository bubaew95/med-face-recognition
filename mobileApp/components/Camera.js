import React, { Component } from "react";
import { View, Text, StyleSheet } from "react-native";

import { Camera } from "expo-camera";
import * as Permissions from "expo-permissions";
import {
  Container,
  Content,
  Header,
  Item,
  Icon,
  Input,
  Button
} from "native-base";
import MaterialCommunityIcons from "react-native-vector-icons/MaterialCommunityIcons";

class CameraComponent extends Component {
  state = {
    hasCameraPermission: null,
    type: Camera.Constants.Type.back
  };

  componentDidMount = async () => {
    const { status } = await Permissions.askAsync(Permissions.CAMERA);

    if (status !== "granted") {
      alert(
        "Hey! You might want to enable notifications for my app, they are good."
      );
    }

    this.setState({ hasCameraPermission: status === "granted" });
  };

  snap = async recognize => {
    try {
      if (this.camera) {
        let photo = await this.camera.takePictureAsync({ base64: true });
        if (!faceDetected) {
          alert("No face detected!");
          return;
        }

        const userId = makeId();
        const { base64 } = photo;
        this[recognize ? "recognize" : "enroll"]({ userId, base64 });
      }
    } catch (e) {
      console.log("error on snap: ", e);
    }
  };

  render() {
    const { hasCameraPermission } = this.state;

    if (hasCameraPermission === null) {
      return <Text> No access to camera</Text>;
    } else if (hasCameraPermission === false) {
      return <Text> No access to camera</Text>;
    } else {
      return (
        <View style={{ flex: 1 }}>
          <Camera
            type={this.state.type}
            style={styles.camera}
            onFacesDetected={this.handleFacesDetected}
          >
            <Header
              searchBar
              rounded
              style={{
                position: "absolute",
                backgroundColor: "transparent",
                left: 0,
                top: 0,
                right: 0,
                zIndex: 100,
                alignItems: "center"
              }}
            >
              <View style={{ flexDirection: "row", flex: 4 }}>
                <Icon name="logo-snapchat" style={{ color: "white" }} />
                <Item style={{ backgroundColor: "transparent" }}>
                  <Icon
                    name="ios-search"
                    style={{ color: "white", fontSize: 24, fontWeight: "bold" }}
                  ></Icon>

                  <Input placeholder="Search" placeholderTextColor="white" />
                </Item>
              </View>

              <View
                style={{
                  flexDirection: "row",
                  flex: 2,
                  justifyContent: "space-around"
                }}
              >
                <Icon
                  name="ios-flash"
                  style={{ color: "white", fontWeight: "bold" }}
                />
                <Icon
                  onPress={() => {
                    this.setState({
                      type:
                        this.state.type === Camera.Constants.Type.back
                          ? Camera.Constants.Type.front
                          : Camera.Constants.Type.back
                    });
                  }}
                  name="ios-reverse-camera"
                  style={{ color: "white", fontWeight: "bold" }}
                />
              </View>
            </Header>

            <View
              style={{
                flexDirection: "row",
                justifyContent: "space-between",
                paddingHorizontal: 10,
                marginBottom: 15,
                alignItems: "flex-end"
              }}
            >
              <MaterialCommunityIcons
                name="message-reply"
                style={{ color: "white", fontSize: 36 }}
              ></MaterialCommunityIcons>

              <View style={{ alignItems: "center" }}>
                <MaterialCommunityIcons
                  name="circle-outline"
                  style={{ color: "white", fontSize: 100 }}
                ></MaterialCommunityIcons>
                <Icon
                  name="ios-images"
                  style={{ color: "white", fontSize: 36 }}
                />
              </View>
              <MaterialCommunityIcons
                name="google-circles-communities"
                style={{ color: "white", fontSize: 36 }}
              ></MaterialCommunityIcons>
            </View>
          </Camera>
        </View>
      );
    }
  }
}
export default CameraComponent;

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: "center",
    justifyContent: "center"
  },
  camera: {
    flex: 1,
    justifyContent: "space-between"
  }
});
