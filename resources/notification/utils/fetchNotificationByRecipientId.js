import { http } from "../../js/utils/http";

export const fetchNotificationByRecipientId = async (id, params = null) => {
    try {
        const { data } = await http.get(
            "/notification/recipient/" + id,
            params
        );

        return data;
    } catch (err) {
        console.log(err);
        return [];
    }
};
