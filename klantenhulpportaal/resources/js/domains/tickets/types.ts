export interface Ticket {
    id: number;
    title: string;
    content: string;
    creator_id: number;
    status: 'Pending' | 'In progress' | 'Resolved';
    created_at: EpochTimeStamp;
    updated_at: EpochTimeStamp;
}
