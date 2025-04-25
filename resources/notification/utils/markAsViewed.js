import { http } from "../../js/utils/http";

export const markAsViewed = async (id) => {
    await http.patch(`/notifications/notification-recipient/${id}/mark-as-viewed`, {
        viewed_at: new Date().toISOString(),
    });
};
