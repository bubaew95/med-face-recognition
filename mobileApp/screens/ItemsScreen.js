import React from "react";
import {
  RefreshControl,
  View,
  FlatList,
  StyleSheet,
  Image,
  TouchableOpacity
} from "react-native";
import Constants from "expo-constants";
import {
  Card,
  CardItem,
  Text,
  Left,
  Body,
  Container,
  Content
} from "native-base";

export default class ItemsScreen extends React.Component {
  state = {
    code: 0,
    data: []
  };

  componentDidMount = () => {
    const {
      data: { data, code }
    } = this.props.navigation.state.params;
    console.log(data);
    this.setState({ data: data, code: code });
  };

  _onPressItem = (id, img) => {
    this.props.navigation.navigate("ViewItem", {
      animation: "ModalSlideFromBottom",
      id: id,
      img: img
    });
  };

  render() {
    const { data, code } = this.state;
    if (code == 200 && data == null) {
      return (
        <View style={styles.container}>
          <Text>Нет совпадений</Text>
        </View>
      );
    }
    return (
      <Container>
        <Content padder>
          <FlatList
            data={data}
            keyExtractor={(item, index) => item.id.toString()}
            refreshControl={
              <RefreshControl
                refreshing={false}
                onRefresh={console.log("ref: 2")}
              />
            }
            renderItem={({ item }) => (
              <TouchableOpacity
                onPress={() => this._onPressItem(item.id_pacient, item.img)}
                key={item.id}
              >
                <Card>
                  <CardItem>
                    <Left>
                      <Body>
                        <Text style={{ fontSize: 18, fontWeight: "bold" }}>
                          {item.name}
                        </Text>
                      </Body>
                    </Left>
                  </CardItem>
                  <CardItem cardBody>
                    <Image
                      source={{
                        uri: `http://217.61.113.12/uploads/${item.id_pacient}/${item.img}`
                      }}
                      style={{ flex: 1, height: 200, width: null }}
                      resizeMode="cover"
                    />
                  </CardItem>
                </Card>
              </TouchableOpacity>
            )}
          />
        </Content>
      </Container>
    );
  }
}

ItemsScreen.navigationOptions = {
  title: "Больничные карты",
  headerStyle: {
    backgroundColor: "#35c376",
    elevation: 0,
    shadowOpacity: 0,
    border: 0
  },
  headerTintColor: "#fff",
  headerTitleStyle: {
    fontWeight: "bold"
  }
};

const styles = StyleSheet.create({
  captureButton: {
    width: 30,
    height: 30,
    borderRadius: 5,
    backgroundColor: "#ffffff"
  },
  container: {
    flex: 1,
    justifyContent: "center",
    paddingTop: Constants.statusBarHeight,
    backgroundColor: "#ecf0f1",
    padding: 8
  }
});
