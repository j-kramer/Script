export interface Ticket {
    id: number;
    title: string;
    content: string;
    creator_id: number;
    assignee_id: number | null;
    status: Status;
    categories: number[];
    created_at: EpochTimeStamp;
    updated_at: EpochTimeStamp;
}

export enum Status {
    pending = 'Pending',
    inProgress = 'In progress',
    resolved = 'Resolved',
}
