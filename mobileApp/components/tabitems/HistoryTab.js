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
const HistoryTab = ({ items, img, isLoading }) => {
  if (isLoading) {
    return <Spinner color="green" />;
  }

  if (items.length == 0) {
    return <Text styles={styles.emptyItems}> Записи врачей отсутствуют! </Text>;
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
        Всего записей: {items.length}
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
                  Дата осмотра{" "}
                  <Text style={styles.textStyle}>{item.date_inspection}</Text>{" "}
                  на приеме, на дому, в фельдшерско-акушерском пункте, прочее.
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Врач (специальность){" "}
                  <Text style={styles.textStyle}>{item.doctor}</Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Жалобы пациента{" "}
                  <Text style={styles.textStyle}>
                    {item.patient_complaints}
                  </Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Анамнез заболевания, жизни{" "}
                  <Text style={styles.textStyle}>{item.diagnosis_underly}</Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Объективные данные{" "}
                  <Text style={styles.textStyle}>{item.objective_data}</Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Сопутствующие заболевания{" "}
                  <Text style={styles.textStyle}>
                    {item.concomitant_disease}
                  </Text>
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Осложнения{" "}
                  <Text style={styles.textStyle}>{item.complication}</Text>{" "}
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Внешняя причина при травмах (отравлениях){" "}
                  <Text style={styles.textStyle}>{item.external_cause}</Text>{" "}
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Группа здоровья{" "}
                  <Text style={styles.textStyle}>{item.health_group}</Text>{" "}
                </Text>
              </Body>
            </CardItem>
            <CardItem bordered>
              <Body>
                <Text style={styles.parentText}>
                  Диспансерное наблюдение{" "}
                  <Text style={styles.textStyle}>
                    {item.dispensary_observation}
                  </Text>{" "}
                </Text>
              </Body>
            </CardItem>
          </Card>
        )}
      />
    </Content>
  );
};

export default HistoryTab;

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
