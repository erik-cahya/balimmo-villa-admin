$(document).ready(function () {
    $('.showDetails').on('click', function () {
        let leadId = $(this).data('data-id');
        let tablePropertiesID = '#propertiesLeadsDetails-' + leadId;
        let tableLandID = '#landLeadsDetails-' + leadId;
        let selectAgent = '#choose_agent-' + leadId;
        // $('#detailsVilla').hide();
        // $('#detailsLand').hide();

        $.get('/leads/' + leadId + '/matching-properties', function (response) {

            // Properties Match
            let tablePropertiesHTML = '';
            let tableLandHTML = '';
            let propertiesDataLeadsHTML = '';
            let agentHTML = '';
            let addedAgents = new Set(); // no duplicate

            if (response.asset.properties && response.asset.properties.length > 0) {
                $.each(response.asset.properties, function (index, property) {

                    tablePropertiesHTML += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${property.property_name}</td>
                                    <td>${property.internal_reference}</td>
                                    <td>${property.bedroom}</td>
                                    <td>
                                        <div class="d-block" bis_skin_checked="1">
                                            <h5 class="text-dark fw-medium mb-0" data-bs-toggle="modal" data-bs-target="#editMatchProperties-4">
                                                IDR ${property.selling_price_idr}
                                            </h5>
                                            <p class="fs-13 mb-0">USD ${property.selling_price_usd}</p>
                                        </div>
                                    </td>
                                    <td>${property.property_address}, ${property.sub_region}, ${property.region}</td>
                                </tr>
                            `;

                    propertiesDataLeadsHTML += `
                                <input type="hidden" name="properties_name[${property.properties_id}]" value="${property.property_name}">
                            `;
                    // console.log(response.properties)
                    // Agent HTML - hanya tambahkan jika belum ada
                    if (!addedAgents.has(property.name)) {
                        addedAgents.add(property.name); // tambahkan ke Set
                        agentHTML += `
                                        <option value="${property.internal_reference}">${property.name}</option>
                                    `;
                    }
                });
            };

            // Properties Land
            if (response.asset.land && response.asset.land.length > 0) {
                $.each(response.asset.land, function (index, property) {
                    tableLandHTML += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${property.property_name}</td>
                                    <td>${property.internal_reference}</td>
                                    <td>${property.bedroom}</td>
                                    <td>
                                        <div class="d-block" bis_skin_checked="1">
                                            <h5 class="text-dark fw-medium mb-0" data-bs-toggle="modal" data-bs-target="#editMatchProperties-4">
                                                IDR ${property.selling_price_idr}
                                            </h5>
                                            <p class="fs-13 mb-0">USD ${property.selling_price_usd}</p>
                                        </div>
                                    </td>
                                    <td>${property.property_address}, ${property.sub_region}, ${property.region}</td>
                                </tr>
                            `;

                    propertiesDataLeadsHTML += `
                                <input type="hidden" name="properties_name[${property.properties_id}]" value="${property.property_name}">
                            `;

                    // Agent HTML - hanya tambahkan jika belum ada
                    if (!addedAgents.has(property.name)) {
                        addedAgents.add(property.name); // tambahkan ke Set
                        agentHTML += `
                                        <option value="${property.name}">${property.name}</option>
                                    `;
                    }
                });
            }

            // Tampilkan hasil
            if (tablePropertiesHTML !== '' || tableLandHTML !== '') {
                if ($.fn.DataTable.isDataTable(tablePropertiesID)) {
                    $(tablePropertiesID).DataTable().destroy();
                }
                $('.detailsPropertyTables').html(tablePropertiesHTML);
                $(tablePropertiesID).DataTable();

                if ($.fn.DataTable.isDataTable(tableLandID)) {
                    $(tableLandID).DataTable().destroy();
                }
                $('.detailsLandTables').html(tableLandHTML);
                $(tableLandID).DataTable();

                $(selectAgent).html(agentHTML);
                $('.propertiesDataLeads').html(propertiesDataLeadsHTML);

            } else {
                // $('.detailsPropertyTables').hide();
            }


        });

    });
});