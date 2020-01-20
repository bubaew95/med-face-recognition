import React from "react";
import { Image, StyleSheet, FlatList, RefreshControl } from "react-native";
import {
  Card,
  CardItem,
  Body,
  Text,
  View,
  Content,
  Spinner,
  Left
} from "native-base";
const ObservationTab = ({ items, img, isLoading }) => {
  if (isLoading) {
    return <Spinner color="green" />;
  }

  if (items.length == 0) {
    return <Text styles={styles.emptyItems}> Наблюдения отсутствуют! </Text>;
  }

  return (
    <Content padder>
      <Text
        style={{
          textAlign: "center",
          flex: 1,
          alignItems: "center",
          marginBottom: 10
        }}
      >
        Всего наблюдений: {items.length}
      </Text>
      <FlatList
        data={items}
        keyExtractor={(item, index) => item.id.toString()}
        refreshControl={
          <RefreshControl
            refreshing={false}
            onRefresh={console.log("ref: 2")}
          />
        }
        renderItem={({ item }) => (
          <Card>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Дата: <Text style={styles.textStyle}>{item.date}</Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Жалобы: <Text style={styles.textStyle}>{item.complaint}</Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Данные наблюдения в динамике:{" "}
                  <Text style={styles.textStyle}>
                    {item.observation_dynamics}
                  </Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Назначения (исследования, консультации):{" "}
                  <Text style={styles.textStyle}>{item.appointment}</Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Лекарственные препараты, физиотерапия:{" "}
                  <Text style={styles.textStyle}>{item.drug}</Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Листок нетрудоспособности, справка:{" "}
                  <Text style={styles.textStyle}>
                    {item.certificate_incapacity}
                  </Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Льготные рецепты:{" "}
                  <Text style={styles.textStyle}>
                    {item.preferential_recipes}
                  </Text>{" "}
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Внешняя причина при травмах (отравлениях):{" "}
                  <Text style={styles.textStyle}>{item.external_cause}</Text>{" "}
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Врач: <Text style={styles.textStyle}>{item.doctor}</Text>{" "}
                </Text>
              </Body>
            </CardItem>
          </Card>
        )}
      />
    </Content>
  );
};

export default ObservationTab;

const styles = StyleSheet.create({
  parentText: {
    fontSize: 12
  },
  textStyle: {
    fontSize: 12,
    fontWeight: "bold",
    paddingLeft: 10,
    marginRight: 10
  },
  emptyItems: {
    justifyContent: "center",
    alignItems: "center"
  }
});
