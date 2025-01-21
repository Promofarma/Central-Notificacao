import { http } from "../js/utils/http";

const createContainer = () => {
    const container = document.createElement("div");

    container.classList.add("toast-container");

    return container;
};

const createList = () => {
    const list = document.createElement("ul");

    list.classList.add("toast-list");

    return list;
};

const createCloseButton = (listItem) => {
    const closeButton = document.createElement("button");

    closeButton.classList.add("toast-close-button");

    closeButton.setAttribute("aria-label", "Fechar notificação");

    closeButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>`;

    let isProcessing = false;

    const handleClick = async () => {
        isProcessing = true;

        try {
            const ip = async () => {
                const { data } = await http.get(
                    "https://api.ipify.org?format=json"
                );

                return data.ip;
            };

            ip().then(async (ip) => {
                await http.patch(
                    `/notification/recipient/${listItem.id}/mark-as-viewed`,
                    {
                        viewed_at: new Date().toISOString(),
                        ip_address: ip,
                    }
                );
            });

            closeButton.removeEventListener("click", handleClick);

            listItem.remove();
        } catch (err) {
            console.log(err);
        } finally {
            isProcessing = false;
        }
    };

    closeButton.addEventListener("click", handleClick);

    return closeButton;
};

const createListItem = ({ id, title, created_by, created_at }) => {
    const listItem = document.createElement("li");

    listItem.classList.add("toast-item");

    listItem.setAttribute("id", id);
    listItem.setAttribute("role", "alert");
    listItem.setAttribute("aria-live", "assertive");

    listItem.innerHTML = `
        <header class="toast-item-header">
            <h3>${title}</h3>
            <p>Enviado por <strong>${created_by}</strong> em ${created_at}</p>
        </header>
    `;

    listItem.appendChild(createCloseButton(listItem));

    return listItem;
};

const initializeToast = () => {
    const body = document.querySelector("body");
    const store = body.getAttribute("data-store");

    if (!store) {
        console.log("Attribute [data-store] not defined in body");
        return;
    }

    const container = createContainer();

    const list = createList();

    const getUnviewedNotifications = async () => {
        try {
            const { data } = await http.get(
                `/notification/recipient/${store}?viewed_status=unviewed`
            );

            return data;
        } catch (error) {
            return [];
        }
    };

    getUnviewedNotifications().then(({ data }) => {
        const items = data.map(createListItem);

        items.forEach((item) => list.append(item));
    });

    container.append(list);

    body.appendChild(container);
};

initializeToast();
