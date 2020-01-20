import React from "react";
import { View, Image, ScrollView } from "react-native";

import styles from "./CameraStyle";

export default ({ captures = [], sendServer }) => (
  <ScrollView
    horizontal={true}
    style={[styles.bottomToolbar, styles.galleryContainer]}
  >
    {captures.map(({ uri, base64 }) => (
      <View
        onPress={() => sendServer(base64)}
        style={styles.galleryImageContainer}
        key={uri}
      >
        <Image source={{ uri }} style={styles.galleryImage} />
      </View>
    ))}
  </ScrollView>
);
