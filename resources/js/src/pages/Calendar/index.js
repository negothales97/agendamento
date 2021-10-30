import React, { useEffect, useState } from 'react';

import FullCalendar from '@fullcalendar/react' // must go before plugins
import dayGridPlugin from '@fullcalendar/daygrid' // a plugin!
import interactionPlugin from '@fullcalendar/interaction';
import ptBrLocale from '@fullcalendar/core/locales/pt-br';
import ScheduleModal from '../../components/Modals/Schedule';
import api from '../../services/api';

const Calendar = () => {
    const [schedules, setSchedules] = useState([]);
    const [mainSchedule, setMainSchedule] = useState(null);
    const [refresh, setRefresh] = useState(false);
    const [places, setPlaces] = useState([]);
    const [specialistId] = useState(document.getElementById('specialist_id').value);
    useEffect(() => {
        api.get(`schedules/${specialistId}/specialist`)
            .then(({ data }) => {
                let scheduleData = data.schedules.map(schedule => {
                    return {
                        id: schedule.id,
                        title: `${schedule.init_hour} - ${schedule.final_hour} - ${schedule.status === 0 ? 'Disponível' : 'Consulta Agendada'}`,
                        start: schedule.date,
                        backgroundColor: `${schedule.status === 0 ? '#3a87ad' : '#dd4b39'}`,
                        borderColor: `${schedule.status === 0 ? '#3a87ad' : '#dd4b39'}`,
                    }
                });
                setSchedules(currentSchedules => scheduleData);
                setPlaces(currentPlaces => data.places)
            })
            .catch((error) => {
                console.log(error);
            });
    }, [refresh]);

    const updateSchedules = () => {
        setRefresh(!refresh);
        setMainSchedule(null);
    }

    const handleSchedules = (schedule) => {
        setMainSchedule(null);
        setSchedules(currentSchedules => [...currentSchedules, schedule]);
    }
    const editableSchedule = async (id) => {
        try {
            const { data } = await api.get(`schedules/${id}`);
            setMainSchedule(data.schedule);
            $('#modalSchedule').modal('show');
        } catch (error) {
            console.log(error);
        }
    }
    return (
        <>
            <ScheduleModal
                handleSchedules={handleSchedules}
                updateSchedules={updateSchedules}
                mainSchedule={mainSchedule}
                places={places}
                />
            <FullCalendar
                locale="pt-br"
                headerToolbar={{
                    start: 'prev, next, today',
                    center: 'title',
                    end: ''
                }}
                buttonText={{
                    today: 'Hoje',
                    month: 'mês'
                }}
                events={schedules}
                editable={true}
                droppable={true}
                eventClick={function (info) {
                    editableSchedule(info.event.id);
                }}
                plugins={[dayGridPlugin, interactionPlugin]}
                initialView="dayGridMonth"
            />
        </>
    );
}
export default Calendar;
