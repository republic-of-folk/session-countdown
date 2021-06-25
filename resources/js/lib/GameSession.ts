export interface IGameSession {
    id: number,
    name: string,
    event_date: Date,

    readonly date: string,
    readonly time: string,
}

export class GameSession implements IGameSession {
    public id: number;
    public name: string;
    public event_date: Date;

    public constructor(id: number, name: string, event_date: Date) {
        this.id = id;
        this.name = name;
        this.event_date = event_date;
    }

    public get date(): string {
        return this.event_date.toISOString().slice(0, 10);
    }

    public get time(): string {
        return this.event_date.toISOString().slice(11, 16);
    }
}
