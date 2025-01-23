import body from "./utils/body";
import { fetchNotificationByRecipientId } from "./utils/fetchNotificationByRecipientId";

import { initToast } from "./toast";
import { initPanel } from "./panel";

initPanel({
    body: body,
    notifications: fetchNotificationByRecipientId,
});

initToast({
    body: body,
    notifications: fetchNotificationByRecipientId,
});
