import React, { useEffect, useState, useRef } from "react";
import { useForm } from "react-hook-form";
import { toCurrency } from "../../../utils/helpers";
import api from "../../../services/api";
const Schedule = ({
    handleSchedules,
    updateSchedules,
    mainSchedule = null,
    places = []
}) => {
    const {
        register,
        handleSubmit,
        setValue,
        watch,
        formState: { errors }
    } = useForm();
    const [specialistId] = useState(
        document.getElementById("specialist_id").value
    );
    const [useOnline] = useState(document.getElementById("use_online").value);
    const [price, setPrice] = useState("");

    const status = useRef({});
    status.current = watch("status", 0);

    const onSubmit = async fields => {
        fields.price = price;
        if (mainSchedule !== null) {
            fields._method = "put";
            await api.post(`schedules/${mainSchedule.id}`, fields);
            updateSchedules();
        } else {
            const { data } = await api.post(`schedules`, fields);
            let schedule = {
                id: data.schedule.id,
                title: `${data.schedule.init_hour} - ${
                    data.schedule.final_hour
                } - ${
                    data.schedule.status == 0
                        ? "Disponível"
                        : "Consulta Agendada"
                }`,
                start: data.schedule.date
            };
            handleSchedules(schedule);
        }

        resetValues();
        $("#modalSchedule").modal("hide");
    };

    const resetValues = () => {
        setValue("date", "");
        setValue("init_hour", "");
        setValue("final_hour", "");
        setValue("place_id", "");
        setValue("status", 0);
        setPrice("");
    };

    $("#modalSchedule").on("hide.bs.modal", function() {
        updateSchedules();
        resetValues();
    });

    const removeSchedule = async () => {
        await api.post(`schedules/${mainSchedule.id}`, {
            _method: "delete"
        });
        updateSchedules();
    };
    useEffect(() => {
        setValue("status", 0);
        if (mainSchedule !== null) {
            setValue("date", mainSchedule.date);
            setValue("init_hour", mainSchedule.init_hour);
            setValue("final_hour", mainSchedule.final_hour);
            setValue("place_id", mainSchedule.place_id ?? 0);
            setValue("status", mainSchedule.status);
            setPrice(mainSchedule.price);
        }
    }, [mainSchedule]);
    return (
        <div className="modal fade" id="modalSchedule">
            <div className="modal-dialog">
                <div className="modal-content">
                    <div className="modal-header">
                        <button
                            type="button"
                            className="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 className="modal-title">Disponibilizar horário</h4>
                    </div>
                    <form onSubmit={handleSubmit(onSubmit)}>
                        <div className="modal-body">
                            <input
                                type="hidden"
                                name="specialist_id"
                                defaultValue={specialistId}
                                {...register("specialist_id")}
                            />
                            <div className="row">
                                <div className="col-sm-4">
                                    <div className="form-group">
                                        <label>Data</label>
                                        <input
                                            type="date"
                                            className="form-control pull-right"
                                            name="date"
                                            {...register("date")}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-group">
                                        <label>Início</label>
                                        <input
                                            type="time"
                                            className="form-control pull-right"
                                            name="init_hour"
                                            {...register("init_hour")}
                                        />
                                    </div>
                                </div>
                                <div className="col-sm-4">
                                    <div className="form-group">
                                        <label>Fim</label>
                                        <input
                                            type="time"
                                            className="form-control pull-right"
                                            name="final_hour"
                                            {...register("final_hour")}
                                        />
                                    </div>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-sm-4">
                                    <div className="form-group">
                                        <label>Valor</label>
                                        <div className="input-group date">
                                            <div className="input-group-addon">
                                                R$
                                            </div>
                                            <input
                                                type="text"
                                                className="form-control pull-right"
                                                name="price"
                                                value={price}
                                                onChange={e =>
                                                    setPrice(
                                                        toCurrency(
                                                            e.target.value
                                                        )
                                                    )
                                                }
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div className="col-sm-8">
                                    <div className="form-group">
                                        <label>Local de atendimento</label>
                                        <select
                                            {...register("place_id")}
                                            name="place_id"
                                            className="form-control"
                                        >
                                            <option value="" disabled={true}>
                                                Selecione...
                                            </option>
                                            {useOnline == 1 && (
                                                <option value={0}>
                                                    Atendimento online
                                                </option>
                                            )}
                                            {places.map(place => (
                                                <option
                                                    key={place.id}
                                                    value={place.id}
                                                >
                                                    {place.name}
                                                </option>
                                            ))}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {status.current > 0 && (
                                <div className="row">
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                            <label>Cliente</label>
                                            <input
                                                className="form-control"
                                                type="text"
                                                readOnly={true}
                                                defaultValue={
                                                    mainSchedule?.customer
                                                        ?.full_name
                                                }
                                            />
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                            <label>E-mail cliente</label>
                                            <input
                                                className="form-control"
                                                type="text"
                                                readOnly={true}
                                                defaultValue={
                                                    mainSchedule?.customer
                                                        ?.email
                                                }
                                            />
                                        </div>
                                    </div>
                                </div>
                            )}
                        </div>
                        <div className="modal-footer justify-content-between">
                            {mainSchedule !== null && status.current == 0 && (
                                <button
                                    type="button"
                                    className="btn btn-danger"
                                    onClick={removeSchedule}
                                >
                                    Excluir
                                </button>
                            )}
                            <button
                                type="button"
                                className="btn btn-default"
                                data-dismiss="modal"
                            >
                                Fechar
                            </button>
                            {status.current === 0 && (
                                <button
                                    type="submit"
                                    className="btn btn-primary"
                                >
                                    Salvar
                                </button>
                            )}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};
export default Schedule;
