import React from "react";
import { Modal, View, StyleSheet, Text, ActivityIndicator } from "react-native";

const ProgressDialog = ({ visible }) => (
  <Modal onRequestClose={() => null} visible={visible}>
    <View style={styles.container}>
      <View style={{ borderRadius: 10, backgroundColor: "white", padding: 25 }}>
        <Text style={{ fontSize: 20, fontWeight: "200" }}>Поиск...</Text>
        <ActivityIndicator size="large" />
      </View>
    </View>
  </Modal>
);

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "rgba(0, 0, 0, .5)",
    alignItems: "center",
    justifyContent: "center"
  },
  content: {
    padding: 35,
    backgroundColor: "white"
  },
  title: {
    fontSize: 18,
    fontWeight: "bold"
  },
  loading: {
    flexDirection: "row",
    alignItems: "center"
  },
  loader: {
    flex: 1
  },
  loadingContent: {
    flex: 3,
    fontSize: 16,
    paddingHorizontal: 10
  }
});

export default ProgressDialog;
