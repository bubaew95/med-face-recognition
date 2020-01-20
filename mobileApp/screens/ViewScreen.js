import React, { Component } from "react";
import { StyleSheet } from "react-native";
import { Container, Text, Tab, Tabs, Content } from "native-base";
import axios from "axios";

import CartTab from "../components/tabitems/CartTab";
import HistoryTab from "../components/tabitems/HistoryTab";
import ObservationTab from "../components/tabitems/ObservationTab";

export default class ViewScreen extends Component {
  state = {
    idPacient: 0,
    itemCard: [],
    itemsHistory: [],
    itemsSupervision: [],
    isLoading: true,
    isLoadingHistory: true,
    isLoadingSupervision: true,
    errors: null,
    id: 0,
    img: "",
    currentTab: 0
  };

  componentDidMount = () => {
    const { id, img } = this.props.navigation.state.params;
    console.log("data", this.props.navigation.state.params);
    this.setState({ img: img, idPacient: id });
    this.selectTab(0, id);
  };

  componentDidUpdate = () => {
    // const { currentTab, idPacient } = this.state;
    // if (currentTab == 1) {
    //   this.loadHistory(idPacient);
    // }
    // if (currentTab == 2) {
    //   console.log(" Пока не готово");
    // }
  };

  sendServer = async id => {
    let host = `http://217.61.113.12/api/pacients/${id}`;
    try {
      await axios
        .get(host)
        .then(response => {
          const { data } = response;
          console.log("sendServer", data);
          this.setState({ itemCard: data, isLoading: false });
        })
        .catch(error => {
          this.setState({ isLoading: false, errors: error });
          console.log("😱 error: ", error);
        });
    } catch (e) {
      this.setState({ isLoading: false, errors: e });
      console.log(`😱 Axios request failed: ${e}`);
    }
  };

  loadHistory = async id => {
    let host = `http://217.61.113.12/api/records/${id}`;
    try {
      await axios
        .get(host)
        .then(response => {
          const { data } = response;
          console.log("loadHistory", data);
          this.setState({ itemsHistory: data, isLoadingHistory: false });
        })
        .catch(error => {
          this.setState({ isLoadingHistory: false, errors: error });
          console.log("😱 error: ", error);
        });
    } catch (e) {
      this.setState({ isLoadingHistory: false, errors: e });
      console.log(`😱 Axios request failed: ${e}`);
    }
  };

  loadSupervisions = async id => {
    let host = `http://217.61.113.12/api/supervisions/${id}`;
    try {
      await axios
        .get(host)
        .then(response => {
          const { data } = response;
          console.log("loadHistory", data);
          this.setState({
            itemsSupervision: data,
            isLoadingSupervision: false
          });
        })
        .catch(error => {
          this.setState({ isLoadingSupervision: false, errors: error });
          console.log("😱 error: ", error);
        });
    } catch (e) {
      this.setState({ isLoadingSupervision: false, errors: e });
      console.log(`😱 Axios request failed: ${e}`);
    }
  };

  selectTab = (tabIndex, idPacient) => {
    console.log("tabIndex", tabIndex);
    const { itemCard, itemsHistory, itemsSupervision } = this.state;
    if (tabIndex == 0 && itemCard.length == 0) {
      this.sendServer(idPacient);
    }

    if (tabIndex == 1 && itemsHistory.length == 0) {
      this.loadHistory(idPacient);
    }

    if (tabIndex == 2 && itemsSupervision.length == 0) {
      this.loadSupervisions(idPacient);
    }
  };

  render() {
    const {
      isLoading,
      isLoadingHistory,
      isLoadingSupervision,
      itemCard,
      img,
      itemsHistory,
      itemsSupervision,
      idPacient
    } = this.state;

    if (itemCard.length == 0 && !isLoading) {
      return (
        <Container>
          <Content padder>
            <Text
              style={{
                color: "#777",
                textAlign: "center",
                flex: 1,
                alignItems: "center",
                marginBottom: 10
              }}
            >
              Совпадений не найдено
            </Text>
          </Content>
        </Container>
      );
    }

    return (
      <Container>
        <Tabs onChangeTab={({ i }) => this.selectTab(i, idPacient)}>
          <Tab
            tabStyle={styles.tabStyle}
            textStyle={styles.textStyle}
            activeTabStyle={styles.activeTabStyle}
            activeTextStyle={styles.activeTextStyle}
            tabBarUnderlineStyle={styles.tabBarUnderlineStyle}
            heading="Карта"
          >
            <CartTab item={itemCard} img={img} isLoading={isLoading} />
          </Tab>
          <Tab
            tabStyle={styles.tabStyle}
            textStyle={styles.textStyle}
            activeTabStyle={styles.activeTabStyle}
            activeTextStyle={styles.activeTextStyle}
            tabBarUnderlineStyle={styles.tabBarUnderlineStyle}
            heading="Записи"
          >
            <HistoryTab items={itemsHistory} isLoading={isLoadingHistory} />
          </Tab>
          <Tab
            tabStyle={styles.tabStyle}
            textStyle={styles.textStyle}
            activeTabStyle={styles.activeTabStyle}
            activeTextStyle={styles.activeTextStyle}
            tabBarUnderlineStyle={styles.tabBarUnderlineStyle}
            heading="Набдюдения"
          >
            <ObservationTab
              items={itemsSupervision}
              isLoading={isLoadingSupervision}
            />
          </Tab>
        </Tabs>
      </Container>
    );
  }
}
ViewScreen.navigationOptions = {
  title: "Информация о больном",
  headerStyle: {
    borderBottomWidth: 0,
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
  tabBarUnderlineStyle: {
    backgroundColor: "#ffffff",
    borderColor: "#ffffff"
  },
  tabStyle: {
    backgroundColor: "#35c376"
  },
  textStyle: {
    color: "#fff",
    fontWeight: "bold",
    fontSize: 12
  },
  activeTabStyle: {
    backgroundColor: "#32b76f",
    color: "#fff",
    fontWeight: "bold",
    fontSize: 12,
    borderBottomColor: "#ffffff"
  },
  activeTextStyle: {
    color: "#fff",
    fontWeight: "bold",
    fontSize: 12
  }
});
