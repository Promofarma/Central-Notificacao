export default markAsViewed = async (id) => {
    await http.patch(`/notification/recipient/${id}/mark-as-viewed`, {
        viewed_at: new Date().toISOString(),
        ip_address: "192.168.1.239",
    });
};
