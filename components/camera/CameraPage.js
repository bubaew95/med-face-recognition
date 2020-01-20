// src/camera.page.js file
import React, { Component } from "react";
import { View, Text, ActivityIndicator, Modal } from "react-native";

import { Camera } from "expo-camera";
import * as Permissions from "expo-permissions";

import styles from "./CameraStyle";
import Toolbar from "./toolbar.component";
import Gallery from "./gallery.component";
import axios from "axios";
import ProgressDialog from "../progressbar/ProgressDialog";
import * as ImageManipulator from "expo-image-manipulator";
import * as FileSystem from "expo-file-system";

export default class CameraPage extends Component {
  camera = null;
  state = {
    captures: [],
    flashMode: Camera.Constants.FlashMode.off,
    capturing: null,
    cameraType: Camera.Constants.Type.back,
    hasCameraPermission: null,
    isLoading: false
  };

  /**
   * Вспыщка
   */
  setFlashMode = flashMode => this.setState({ flashMode });

  /**
   * Вид камеры (Фронт, Бэк)
   */
  setCameraType = cameraType => this.setState({ cameraType });

  /**
   * Миниатюрки
   */
  handleCaptureIn = () => this.setState({ capturing: true });

  handleCaptureOut = () => {
    if (this.state.capturing) this.camera.stopRecording();
  };

  handleShortCapture = async () => {
    const photoData = await this.camera.takePictureAsync({
      quality: 0,
      skipProcessing: true
    });
    let resizedPhoto = await ImageManipulator.manipulateAsync(
      photoData.uri,
      [{ resize: { width: 216, height: 384 } }],
      { compress: 0, format: ImageManipulator.SaveFormat.PNG, base64: true }
    );
    const { base64 } = resizedPhoto;
    this.sendServer(base64);
    this.setState({
      capturing: false,
      captures: [resizedPhoto, ...this.state.captures]
    });
  };

  /**
   * Отправка фотографий на сервер
   */
  sendServer = async base64 => {
    let host = "http://217.61.113.12:8080/api/compare-img";
    this.setState({ isLoading: true });
    const data = { base64img: base64 };
    try {
      await axios
        .post(
          host,
          { data },
          {
            headers: {
              "Content-Type": "application/json"
            }
          }
        )
        .then(response => {
          const {
            data: { data }
          } = response;
          console.log("data", data);
          this.setState({ isLoading: false });
          this.props.navigation.navigate("ViewItem", {
            animation: "ModalSlideFromBottom",
            id: data.id_pacient,
            img: data.img
          });
        })
        .catch(error => {
          this.setState({ isLoading: false });
          console.log("😱 error: ", error);
        });
    } catch (e) {
      this.setState({ isLoading: false });
      console.log(`😱 Axios request failed: ${e}`);
    }
  };

  handleLongCapture = async () => {
    const videoData = await this.camera.recordAsync();
    this.setState({
      capturing: false,
      captures: [videoData, ...this.state.captures]
    });
  };

  async componentDidMount() {
    const camera = await Permissions.askAsync(Permissions.CAMERA);
    const audio = await Permissions.askAsync(Permissions.AUDIO_RECORDING);
    const hasCameraPermission =
      camera.status === "granted" && audio.status === "granted";

    this.setState({ hasCameraPermission });
  }

  render() {
    const {
      hasCameraPermission,
      flashMode,
      cameraType,
      capturing,
      captures,
      isLoading
    } = this.state;

    if (isLoading) {
      return <ProgressDialog />;
    }

    if (hasCameraPermission === null) {
      return <View />;
    } else if (hasCameraPermission === false) {
      return <Text>Access to camera has been denied.</Text>;
    }

    return (
      <React.Fragment>
        <View>
          <Camera
            type={cameraType}
            flashMode={flashMode}
            style={styles.preview}
            ref={camera => (this.camera = camera)}
          />
        </View>

        {/* {captures.length > 0 && (
          <Gallery captures={captures} sendServer={this.sendServer} />
        )} */}

        <Toolbar
          capturing={capturing}
          flashMode={flashMode}
          cameraType={cameraType}
          setFlashMode={this.setFlashMode}
          setCameraType={this.setCameraType}
          onCaptureIn={this.handleCaptureIn}
          onCaptureOut={this.handleCaptureOut}
          //   onLongCapture={this.handleLongCapture}
          onShortCapture={this.handleShortCapture}
        />
      </React.Fragment>
    );
  }
}
