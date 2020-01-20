import React from "react";
import { Image, StyleSheet } from "react-native";
import {
  Card,
  CardItem,
  Body,
  Text,
  View,
  Content,
  Spinner
} from "native-base";
const CartTab = ({ item, img, isLoading }) => {
  if (isLoading) {
    return <Spinner color="green" />;
  }

  return (
    <Content>
      <Image
        source={{
          uri: `http://217.61.113.12/uploads/${item.id}/${img}`
        }}
        style={{ height: 300, width: null, flex: 1 }}
      />
      <View padder>
        <Card>
          <CardItem bordered>
            <Body>
              <Text>
                1. Дата заполнения медицинской карты:{" "}
                <Text style={styles.textStyle}>{item.created_at}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                2. Фамилия, имя, отчество{" "}
                <Text style={styles.textStyle}>{item.name}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                3. Пол:{" "}
                <Text style={styles.textStyle}>
                  {item.sex == "m" ? "Муж" : "Жен"}
                </Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                4. Дата рождения:{" "}
                <Text style={styles.textStyle}>{item.birthday}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                5. Место регистрации: субъект Российской Федерации{" "}
                <Text style={styles.textStyle}>{item.permanent_address}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                6. Адрес регистрации по месту пребывания: субъект Российской
                Федерации{" "}
                <Text style={styles.textStyle}>
                  {item.registration_address}
                </Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                7. Полис ОМС: <Text style={styles.textStyle}>{item.polis}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                8. СНИЛС: <Text style={styles.textStyle}>{item.snils}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                9. Наименование страховой медицинской организации{" "}
                <Text style={styles.textStyle}>{item.ins_organization}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                10. Документ (наименование,№,дата,кем выдан):{" "}
                <Text style={styles.textStyle}> {item.passport}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                11. Заболевания, по поводу которых осуществляется диспансерное
                наблюдение: <Text style={styles.textStyle}> </Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                12. Инвалидность (первичная, повторная, группа, дата){" "}
                <Text style={styles.textStyle}> {item.disability}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                13. Место работы, должность{" "}
                <Text style={styles.textStyle}> {item.place_work}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                14. Группа крови{" "}
                <Text style={styles.textStyle}> {item.blood_group}</Text>
              </Text>
            </Body>
          </CardItem>
          <CardItem bordered>
            <Body>
              <Text>
                15. HR фактор{" "}
                <Text style={styles.textStyle}> {item.hr_factor}</Text>
              </Text>
            </Body>
          </CardItem>

          <CardItem bordered>
            <Body>
              <Text>
                16. Аллергические реакции{" "}
                <Text style={styles.textStyle}> {item.allergic}</Text>
              </Text>
            </Body>
          </CardItem>
        </Card>
      </View>
    </Content>
  );
};

export default CartTab;

const styles = StyleSheet.create({
  textStyle: {
    fontWeight: "bold",
    paddingLeft: 10,
    marginRight: 10
  }
});
