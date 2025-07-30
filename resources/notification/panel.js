import { baseUrl } from "../js/utils/baseUrl";

const notificationListItem = ({
    uuid,
    title,
    recipient_id,
    category_id,
    created_by,
    readed_at,
    created_at,
}) => {
    const listItem = document.createElement("li");

    listItem.setAttribute("id", uuid);

    listItem.classList.add("notification-item");

    listItem.innerHTML = `
        <header class="notification-item-header">
            <h3 class="title">${title}</h3>
            <span class="subtitle">
                Enviada por: ${created_by} -
                ${readed_at ? "Lida" : "Não lida"}
            </span>
        </header>
        <footer class="notification-item-footer">
            <a href="${baseUrl}/recipient/${recipient_id}?category=${category_id}&notification=${uuid}" target="_blank">Visualizar</a>
            <span class="time">${created_at}</span>
        </footer>
    `;

    return listItem;
};

const updateUnviewedNotificationCount = (notificationList) => {
    const notificationCountElement = document.querySelector(
        ".notification-count"
    );

    if (!notificationCountElement) {
        return;
    }

    const filterUnreadNotifications = notificationList.filter(
        (n) => !n.readed_at
    );

    console.log(filterUnreadNotifications.length);

    notificationCountElement.textContent = filterUnreadNotifications.length;
};

const updateNotificationPanelBody = (notificationList) => {
    const notificationPanelBody = document.querySelector(
        ".notification-panel-body"
    );

    if (!notificationPanelBody || !notificationList.length) return;

    notificationPanelBody.innerHTML = "";

    const container = document.createElement("ul");

    container.classList.add("notification-list");

    const fragment = document.createDocumentFragment();

    const listItems = notificationList.map(notificationListItem);

    fragment.append(...listItems);

    container.append(fragment);

    notificationPanelBody.appendChild(container);
};

export const initPanel = async ({ body, notifications }) => {
    const storeId = body.storeId;

    if (!storeId) {
        console.log(
            "O atributo [data-store] não está definido no elemento body"
        );
        return;
    }

    const { data } = await notifications(storeId);

    updateUnviewedNotificationCount(data);

    updateNotificationPanelBody(data);
};
